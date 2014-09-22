/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class PreCreateRole extends Rpc
/*    */ {
/*    */   public int retcode;
/*    */   public int roleid;
/*    */   public int logicuid;
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result)
/*    */     throws ProtocolException
/*    */   {
/* 16 */     PreCreateRoleArg arg = (PreCreateRoleArg)argument;
/* 17 */     PreCreateRoleRes res = (PreCreateRoleRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 22 */     PreCreateRoleArg arg = (PreCreateRoleArg)argument;
/* 23 */     PreCreateRoleRes res = (PreCreateRoleRes)result;
/*    */ 
/* 25 */     synchronized (this)
/*    */     {
/* 27 */       this.retcode = res.retcode;
/* 28 */       this.roleid = res.roleid;
/* 29 */       this.logicuid = res.logicuid;
/* 30 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 36 */     synchronized (this)
/*    */     {
/* 38 */       this.retcode = 4;
/* 39 */       this.roleid = -1;
/* 40 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.PreCreateRole
 * JD-Core Version:    0.6.2
 */