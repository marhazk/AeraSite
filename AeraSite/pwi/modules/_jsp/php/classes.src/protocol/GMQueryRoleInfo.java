/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GMQueryRoleInfo extends Rpc
/*    */ {
/*    */   public int retcode;
/* 11 */   public int status = -1;
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result) throws ProtocolException {
/* 14 */     RoleId arg = (RoleId)argument;
/* 15 */     GMQueryRoleInfoRes res = (GMQueryRoleInfoRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 20 */     RoleId arg = (RoleId)argument;
/* 21 */     GMQueryRoleInfoRes res = (GMQueryRoleInfoRes)result;
/* 22 */     synchronized (this)
/*    */     {
/* 24 */       this.retcode = 0;
/* 25 */       this.status = res.status;
/* 26 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 32 */     synchronized (this)
/*    */     {
/* 34 */       this.retcode = 4;
/* 35 */       this.status = -1;
/* 36 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GMQueryRoleInfo
 * JD-Core Version:    0.6.2
 */