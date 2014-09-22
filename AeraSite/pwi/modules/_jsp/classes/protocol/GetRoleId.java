/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GetRoleId extends Rpc
/*    */ {
/*    */   public int retcode;
/*    */   public int roleid;
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result)
/*    */     throws ProtocolException
/*    */   {
/* 15 */     GetRoleIdArg arg = (GetRoleIdArg)argument;
/* 16 */     GetRoleIdRes res = (GetRoleIdRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 21 */     GetRoleIdArg arg = (GetRoleIdArg)argument;
/* 22 */     GetRoleIdRes res = (GetRoleIdRes)result;
/*    */ 
/* 24 */     synchronized (this)
/*    */     {
/* 26 */       this.retcode = res.retcode;
/* 27 */       if (0 == res.retcode)
/* 28 */         this.roleid = res.roleid;
/*    */       else
/* 30 */         this.roleid = -1;
/* 31 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 37 */     synchronized (this)
/*    */     {
/* 39 */       this.retcode = 4;
/* 40 */       this.roleid = -1;
/* 41 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GetRoleId
 * JD-Core Version:    0.6.2
 */