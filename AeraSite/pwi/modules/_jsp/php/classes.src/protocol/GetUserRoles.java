/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data.DataVector;
/*    */ 
/*    */ public final class GetUserRoles extends Rpc
/*    */ {
/*    */   public int retcode;
/*    */   public int userid;
/*    */   public Rpc.Data.DataVector roles;
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result)
/*    */     throws ProtocolException
/*    */   {
/* 17 */     GetUserRolesArg arg = (GetUserRolesArg)argument;
/* 18 */     GetUserRolesRes res = (GetUserRolesRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 23 */     GetUserRolesArg arg = (GetUserRolesArg)argument;
/* 24 */     GetUserRolesRes res = (GetUserRolesRes)result;
/*    */ 
/* 26 */     synchronized (this)
/*    */     {
/* 28 */       this.retcode = res.retcode;
/* 29 */       if (0 == res.retcode)
/*    */       {
/* 31 */         this.userid = arg.userid;
/* 32 */         this.roles = res.roles;
/*    */       }
/*    */       else
/*    */       {
/* 36 */         this.userid = -1;
/* 37 */         this.roles = null;
/*    */       }
/* 39 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 45 */     synchronized (this)
/*    */     {
/* 47 */       this.retcode = 4;
/* 48 */       this.userid = -1;
/* 49 */       this.roles = null;
/* 50 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GetUserRoles
 * JD-Core Version:    0.6.2
 */